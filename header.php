<?php
/**
 * Sovereign Quiet-Luxury Site Header — Keystone Recomposition v4.0
 * Autonomous AI Systems, 25-Release Bio-Acoustic Catalog & Builder Ecosystem
 *
 * @package KeystoneRecompositionChild
 * @version 4.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$current_path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?: '', '/' );
$kr_badge_url = get_stylesheet_directory_uri() . '/assets/images/keystone_real_logo_badge_bold.png';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, interactive-widget=resizes-content">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'keystone-recomposition-dark-luxury kr-sovereign-v4' ); ?>>
<?php wp_body_open(); ?>

<a class="kr-skip-link" href="#content">Skip to main content</a>

<div id="page" class="hfeed site">

    <!-- 1. TOP SOVEREIGN UTILITY STRIP (Possibilities v3.0 Executive Telemetry & Direct Access Pattern) -->
    <div class="kr-utility-bar" role="region" aria-label="Sovereign Telemetry, Broadcast Channels and Buyer Vault">
        <div class="kr-shell-container kr-utility-inner">
            <div class="kr-utility-left">
                <span class="kr-utility-dot" aria-hidden="true"></span>
                <span>28-AGENT FASTMCP SWARMS &middot; 25 MASTER RELEASES (246 TRACKS) &middot; SQUAMISH &amp; WHISTLER, BC</span>
            </div>
            <div class="kr-utility-right">
                <a href="https://www.youtube.com/@KeystoneAIProtocols" target="_blank" rel="noopener noreferrer" class="kr-utility-pill kr-utility-pill--cyan" aria-label="Keystone AI Protocols Official YouTube Channel">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    <span class="kr-util-label-long">@KeystoneAIProtocols</span>
                    <span class="kr-util-label-short">AI YT</span>
                </a>
                <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener noreferrer" class="kr-utility-pill kr-utility-pill--gold" aria-label="Keystone Recomposition Official YouTube Channel">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    <span class="kr-util-label-long">@KeyStoneRecomposition</span>
                    <span class="kr-util-label-short">Music YT</span>
                </a>
                <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="kr-utility-pill kr-utility-pill--cyan" aria-label="Spotify Verified Artist Official Channel">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                    <span class="kr-util-label-long">Spotify Verified</span>
                    <span class="kr-util-label-short">Spotify</span>
                </a>
                <a href="<?php echo esc_url( home_url( '/ai-protocols/#buyer-vault' ) ); ?>" class="kr-utility-vault-pill">
                    Buyer Vault
                </a>
            </div>
        </div>
    </div>

    <!-- 2. PRIMARY STICKY PURE-BLACK NAVIGATION BAR -->
    <header class="site-nav-header" id="kr-sovereign-header">
        <div class="nav-container">

            <!-- Official Keyhole-Arch Shield Badge + Lockup (44x44 Locked) -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-edge-logo" aria-label="Keystone Recomposition Home">
                <div class="kp-badge-mark">
                    <img src="<?php echo esc_url( $kr_badge_url ); ?>" alt="Keystone Recomposition Keyhole-Arch Shield" class="kp-badge-img" width="44" height="44" decoding="async">
                </div>
                <div class="brand-title-wrap">
                    <span class="title-main">KEYSTONE RECOMPOSITION</span>
                    <span class="title-sub">AUTONOMOUS AI &amp; AUDIO SYSTEMS</span>
                </div>
            </a>

            <!-- Desktop Navigation Menu (8 Canonical Hubs) -->
            <nav aria-label="Main Navigation">
                <ul class="nav-links-menu">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link-item <?php echo ( $current_path === '' || is_front_page() ) ? 'active' : ''; ?>">HOME</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="nav-link-item <?php echo ( strpos( $current_path, 'ai-protocols' ) !== false || ( function_exists( 'is_page' ) && is_page( 'ai-protocols' ) ) ) ? 'active' : ''; ?>">AI PROTOCOLS</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/intel/' ) ); ?>" class="nav-link-item nav-link-intel-highlight <?php echo ( strpos( $current_path, 'intel' ) !== false || strpos( $current_path, 'blog' ) !== false || ( function_exists( 'is_singular' ) && is_singular( 'post' ) ) || ( function_exists( 'is_home' ) && is_home() ) ) ? 'active' : ''; ?>"><span class="nav-live-dot" aria-hidden="true"></span>INTEL &amp; VIDEOS</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="nav-link-item <?php echo ( strpos( $current_path, 'sonic-universe' ) !== false || ( function_exists( 'is_page' ) && is_page( 'sonic-universe' ) ) ) ? 'active' : ''; ?>">SONIC UNIVERSE</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/investments/' ) ); ?>" class="nav-link-item <?php echo ( strpos( $current_path, 'investments' ) !== false || ( function_exists( 'is_page' ) && is_page( 'investments' ) ) ) ? 'active' : ''; ?>">INVESTMENTS</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/lifestyle/' ) ); ?>" class="nav-link-item <?php echo ( strpos( $current_path, 'lifestyle' ) !== false || ( function_exists( 'is_page' ) && is_page( 'lifestyle' ) ) ) ? 'active' : ''; ?>">LIFESTYLE</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/founder/' ) ); ?>" class="nav-link-item <?php echo ( strpos( $current_path, 'founder' ) !== false || strpos( $current_path, 'about-the-founder' ) !== false || ( function_exists( 'is_page' ) && ( is_page( 'founder' ) || is_page( 'about-the-founder' ) ) ) ) ? 'active' : ''; ?>">FOUNDER</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="nav-link-item <?php echo ( strpos( $current_path, 'contact' ) !== false || ( function_exists( 'is_page' ) && is_page( 'contact' ) ) ) ? 'active' : ''; ?>">CONTACT</a></li>
                </ul>
            </nav>

            <!-- Right Action Items (Social Icons + AI Vault CTA Pill + Mobile Toggle) -->
            <div class="nav-right-actions">
                <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Spotify Verified Artist OAC" title="Spotify Verified Artist OAC">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                </a>
                <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="YouTube" title="Keystone Recomposition YouTube">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="https://www.instagram.com/keystonerecomposition/" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram" title="Instagram">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="https://www.facebook.com/KeystoneRecomposition" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Facebook" title="Facebook">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="header-protocols-cta-pill">
                    ⚡ AI VAULT
                </a>
                <button type="button" class="mobile-hamburger" id="kpMobileNavToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileDrawer">
                    <span class="mobile-menu-icon" aria-hidden="true">&#9776;</span>
                    <span class="mobile-menu-label">MENU</span>
                </button>
            </div>

        </div>
    </header>

    <!-- 3. SLIDE-OVER MOBILE NAVIGATION DRAWER (#mobileDrawer — Hidden by Default via Critical FOUC Lock) -->
    <div class="kr-drawer-backdrop" id="krMobileDrawerBackdrop" aria-hidden="true"></div>
    <div class="mobile-menu-drawer" id="mobileDrawer" data-wp-uid="<?php echo esc_attr( is_user_logged_in() ? 'KR-WP-UID-' . (int) get_current_user_id() : '' ); ?>" aria-label="Mobile Navigation Drawer" aria-hidden="true">
        <div class="kr-drawer-top">
            <span class="kr-drawer-kicker">KEYSTONE RECOMPOSITION &middot; v4.0</span>
            <button type="button" class="kr-drawer-close-btn" id="krMobileNavClose" aria-label="Close navigation menu">&times;</button>
        </div>

        <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="mobile-drawer-protocols-featured <?php echo ( strpos( $current_path, 'ai-protocols' ) !== false || ( function_exists( 'is_page' ) && is_page( 'ai-protocols' ) ) ) ? 'active' : ''; ?>">
            <div class="drawer-proto-left">
                <span class="drawer-proto-kicker" id="drawerVaultUidBadge">🔐 VAULT UID GATE ACTIVE • AUTOMATED DELIVERY</span>
                <span class="drawer-proto-title">⚡ AI PROTOCOLS — $49.50, $199 &amp; $800 Vault</span>
            </div>
            <span class="drawer-proto-badge">▶ OPEN</span>
        </a>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-drawer-row <?php echo ( $current_path === '' || is_front_page() ) ? 'active' : ''; ?>"><span>🏠 HOME</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/intel/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'intel' ) !== false || strpos( $current_path, 'blog' ) !== false || ( function_exists( 'is_singular' ) && is_singular( 'post' ) ) || ( function_exists( 'is_home' ) && is_home() ) ) ? 'active' : ''; ?>"><span>🎬 INTEL &amp; 4K VIDEOS</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'sonic-universe' ) !== false || ( function_exists( 'is_page' ) && is_page( 'sonic-universe' ) ) ) ? 'active' : ''; ?>"><span>🎵 SONIC UNIVERSE (25 RELEASES)</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/investments/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'investments' ) !== false || ( function_exists( 'is_page' ) && is_page( 'investments' ) ) ) ? 'active' : ''; ?>"><span>📈 INVESTMENTS</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/lifestyle/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'lifestyle' ) !== false || ( function_exists( 'is_page' ) && is_page( 'lifestyle' ) ) ) ? 'active' : ''; ?>"><span>🏔️ LIFESTYLE</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/founder/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'founder' ) !== false || strpos( $current_path, 'about-the-founder' ) !== false || ( function_exists( 'is_page' ) && ( is_page( 'founder' ) || is_page( 'about-the-founder' ) ) ) ) ? 'active' : ''; ?>"><span>👤 FOUNDER</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/ecosystem-partners/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'ecosystem-partners' ) !== false || ( function_exists( 'is_page' ) && is_page( 'ecosystem-partners' ) ) ) ? 'active' : ''; ?>"><span>🤝 ECOSYSTEM PARTNERS</span><span class="drawer-row-arrow">&rarr;</span></a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-drawer-row <?php echo ( strpos( $current_path, 'contact' ) !== false || ( function_exists( 'is_page' ) && is_page( 'contact' ) ) ) ? 'active' : ''; ?>"><span>✉️ CONTACT</span><span class="drawer-row-arrow">&rarr;</span></a>

        <div class="kr-drawer-sister-box">
            <span>Sister Empire Division &middot; BC Housing #52603</span>
            <a href="https://keystonepossibilities.ca/" target="_blank" rel="noopener">Keystone Possibilities Ltd. &mdash; Custom Estates, Bill 44 &amp; ES54 Civil &rarr;</a>
        </div>
    </div>

    <!-- SCRIPT FOR MOBILE DRAWER TOGGLE & VAULT UID CHECK -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleBtn = document.getElementById('kpMobileNavToggle');
        var closeBtn = document.getElementById('krMobileNavClose');
        var drawer = document.getElementById('mobileDrawer');
        var backdrop = document.getElementById('krMobileDrawerBackdrop');
        var uidBadge = document.getElementById('drawerVaultUidBadge');

        function syncDrawerVaultUid() {
            if (!uidBadge || !drawer) return;
            var storedUid = '';
            try { storedUid = localStorage.getItem('kr_user_vault_uid') || ''; } catch (e) {}
            var wpUid = drawer.getAttribute('data-wp-uid') || '';
            var activeUid = storedUid || wpUid;
            if (activeUid) {
                uidBadge.textContent = '✔ UID VERIFIED: ' + activeUid;
                uidBadge.style.color = '#f6d365';
            }
        }

        function setDrawerOpen(open) {
            if (!drawer || !toggleBtn) return;
            if (open) {
                syncDrawerVaultUid();
            }
            drawer.classList.toggle('active', open);
            drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
            toggleBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (backdrop) {
                backdrop.classList.toggle('active', open);
            }
            document.body.style.overflow = open ? 'hidden' : '';
        }

        syncDrawerVaultUid();

        if (toggleBtn && drawer) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                setDrawerOpen(!drawer.classList.contains('active'));
            });
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    setDrawerOpen(false);
                });
            }
            if (backdrop) {
                backdrop.addEventListener('click', function() {
                    setDrawerOpen(false);
                });
            }
            drawer.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    setDrawerOpen(false);
                });
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && drawer.classList.contains('active')) {
                    setDrawerOpen(false);
                    toggleBtn.focus();
                }
            });
        }
    });
    </script>

    <div id="content" class="site-content">
