<?php
/**
 * The header for Keystone Recomposition Child Theme.
 * Evidence-Based AI Systems, Sonic Architecture & Lifestyle Investments
 *
 * @package KeystoneRecompositionChild
 * @version 3.6.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, interactive-widget=resizes-content">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'keystone-recomposition-dark-luxury' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="hfeed site">

    <!-- COMPACT SITE NAVIGATION HEADER (Exact Match to keystonepossibilities.ca Standard) -->
    <header class="site-nav-header">
        <div class="nav-container">
            
            <!-- Wayne's Real Logo Branding on Left Edge -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-edge-logo" aria-label="Keystone Recomposition Home">
                <div class="kp-badge-mark">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/keystone_real_logo_badge_bold.png' ); ?>" alt="Keystone" class="kp-badge-img">
                </div>
                <div class="brand-title-wrap">
                    <span class="title-main">KEYSTONE RECOMPOSITION</span>
                    <span class="title-sub">AUTONOMOUS AI &amp; AUDIO SYSTEMS</span>
                </div>
            </a>

            <!-- Desktop Navigation Menu -->
            <nav aria-label="Main Navigation">
                <ul class="nav-links-menu">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link-item <?php echo ( is_front_page() || is_home() ) ? 'active' : ''; ?>">HOME</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="nav-link-item <?php echo is_page( 'ai-protocols' ) ? 'active' : ''; ?>">AI PROTOCOLS</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/intel/' ) ); ?>" class="nav-link-item <?php echo is_page( 'intel' ) ? 'active' : ''; ?>">INTEL</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="nav-link-item <?php echo is_page( 'sonic-universe' ) ? 'active' : ''; ?>">SONIC UNIVERSE</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about-the-founder/' ) ); ?>" class="nav-link-item <?php echo is_page( 'about-the-founder' ) ? 'active' : ''; ?>">FOUNDER</a></li>
                </ul>
            </nav>

            <!-- Right Action Items (Social Icons in Luminous Cyan) -->
            <div class="nav-right-actions">
                <a href="https://www.facebook.com/profile.php?id=61561081702787" target="_blank" rel="noopener" class="social-icon-btn" aria-label="Facebook">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://www.instagram.com/keystonerecomposition/" target="_blank" rel="noopener" class="social-icon-btn" aria-label="Instagram">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener" class="social-icon-btn" aria-label="YouTube">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <button class="mobile-hamburger" id="kpMobileNavToggle" aria-label="Toggle navigation menu">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 6h18M3 18h18"/></svg>
                </button>
            </div>

        </div>
    </header>

    <!-- MOBILE NAVIGATION DRAWER -->
    <div class="mobile-menu-drawer" id="mobileDrawer">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo ( is_front_page() || is_home() ) ? 'active' : ''; ?>">HOME</a>
        <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="<?php echo is_page( 'ai-protocols' ) ? 'active' : ''; ?>">AI PROTOCOLS</a>
        <a href="<?php echo esc_url( home_url( '/intel/' ) ); ?>" class="<?php echo is_page( 'intel' ) ? 'active' : ''; ?>">INTEL</a>
        <a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="<?php echo is_page( 'sonic-universe' ) ? 'active' : ''; ?>">SONIC UNIVERSE</a>
        <a href="<?php echo esc_url( home_url( '/about-the-founder/' ) ); ?>" class="<?php echo is_page( 'about-the-founder' ) ? 'active' : ''; ?>">FOUNDER</a>
    </div>

    <!-- SCRIPT FOR MOBILE DRAWER TOGGLE -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('kpMobileNavToggle');
        const drawer = document.getElementById('mobileDrawer');
        if (toggleBtn && drawer) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                drawer.classList.toggle('active');
            });
            document.addEventListener('click', function(e) {
                if (drawer.classList.contains('active') && !drawer.contains(e.target) && e.target !== toggleBtn) {
                    drawer.classList.remove('active');
                }
            });
        }
    });
    </script>

    <div id="content" class="site-content">
