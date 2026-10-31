<?php
/**
 * Keystone Recomposition - Google Search Console Reset & HTTP 410/301 Hygiene Engine
 * Version: 3.3.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 * Purpose: Enforces deterministic HTTP 410 Gone on permanently retired legacy routes
 *          and deep thin pagination, single-hop HTTP 301 redirects for legacy slugs,
 *          and clean Rank Math XML sitemap filtering.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Emits a clean Quiet Luxury HTTP 410 Gone response and terminates execution.
 */
function keystone_emit_clean_410_gone(): void {
    status_header( 410 );
    if ( function_exists( 'nocache_headers' ) ) {
        nocache_headers();
    }
    header( 'Content-Type: text/html; charset=utf-8' );
    header( 'X-Robots-Tag: noindex, nofollow' );
    header( 'X-LiteSpeed-Cache-Control: no-cache' );
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="robots" content="noindex, nofollow"><title>410 Gone — Keystone Recomposition</title></head>';
    echo '<body style="background:#04070d;color:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,sans-serif;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;padding:24px;">';
    echo '<main style="max-width:560px;background:rgba(10,15,28,0.88);border:1px solid rgba(212,175,55,0.4);border-radius:18px;padding:36px;text-align:center;">';
    echo '<p style="margin:0 0 8px;color:#d4af37;font-size:12px;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;">HTTP 410 GONE</p>';
    echo '<h1 style="margin:0 0 12px;font-size:24px;color:#ffffff;">Resource Permanently Retired</h1>';
    echo '<p style="margin:0 0 24px;color:#94a3b8;font-size:15px;line-height:1.6;">This legacy URL has been permanently removed from Keystone Recomposition.</p>';
    echo '<a href="https://keystonerecomposition.com/" style="display:inline-block;padding:12px 28px;border-radius:9999px;background:#d4af37;color:#04070d;font-weight:800;text-decoration:none;font-size:13px;letter-spacing:0.06em;text-transform:uppercase;">Return to Command Hub</a>';
    echo '</main></body></html>';
    exit;
}

/**
 * Early HTTP 410 Gone & Canonical 301 Interceptor (runs at priority 0 on init & template_redirect).
 */
function keystone_early_410_and_301_gate(): void {
    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return;
    }

    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    if ( '' === $request_uri ) {
        return;
    }

    $raw_path = (string) ( parse_url( $request_uri, PHP_URL_PATH ) ?: '' );
    $path     = strtolower( trim( $raw_path, '/' ) );
    if ( '' === $path ) {
        return;
    }

    // 1. Strict HTTP 410 Gone routes (before any canonical or fallback redirect)
    if ( preg_match( '~^pep[a-z]*-protocol-guide$~i', $path ) ) {
        keystone_emit_clean_410_gone();
    }
    if ( preg_match( '~^intel/page/([3-9]|[1-9][0-9]+)$~i', $path ) ) {
        keystone_emit_clean_410_gone();
    }

    // 2. Clean single-hop HTTP 301 Redirects for legacy slugs
    if ( 'music-releases' === $path ) {
        header( 'X-LiteSpeed-Cache-Control: no-cache' );
        wp_safe_redirect( home_url( '/sonic-universe/' ), 301 );
        exit;
    }
    if ( 'old-store' === $path ) {
        header( 'X-LiteSpeed-Cache-Control: no-cache' );
        wp_safe_redirect( home_url( '/ai-protocols/' ), 301 );
        exit;
    }
    if ( 'watch-iron-grace-2' === $path ) {
        header( 'X-LiteSpeed-Cache-Control: no-cache' );
        wp_safe_redirect( home_url( '/watch-iron-grace/' ), 301 );
        exit;
    }
    if ( in_array( $path, array( 'about', 'about-the-founder', 'about-the-founder-the-keystone-blueprint' ), true ) ) {
        wp_safe_redirect( home_url( '/founder/' ), 301 );
        exit;
    }
    if ( 'album' === $path || str_starts_with( $path, 'album/' ) || 'track' === $path || str_starts_with( $path, 'track/' ) ) {
        wp_safe_redirect( home_url( '/sonic-universe/' ), 301 );
        exit;
    }
}
add_action( 'init', 'keystone_early_410_and_301_gate', 0 );
add_action( 'template_redirect', 'keystone_early_410_and_301_gate', 0 );

/**
 * Canonical legacy slug patterns to permanently retire from sitemaps and non-sovereign routes.
 */
function keystone_get_purged_slug_patterns(): array {
    return array(
        'wolverine-stack',
        'wolverine-protocol',
        'bacteriostatic',
        'reconstitution',
        'calculator',
        'calculators',
        'keystone-kitchen',
        'the-kitchen',
        'kitchen',
        'the-forge',
        'forge',
        'mental-strength',
        'recommended-gear',
        'gear-codes',
        'global-protocols',
        'europe-longevity',
        'mexico-longevity',
        'london-longevity',
        'la-longevity',
        'newyork-longevity',
        'workout',
    );
}

/**
 * Checks if a given URI or slug matches any purged legacy pattern.
 */
function keystone_is_purged_url( string $uri ): bool {
    $uri_clean = strtolower( trim( (string) ( parse_url( $uri, PHP_URL_PATH ) ?: $uri ), '/' ) );

    // Explicit allowlist for core sovereign ecosystem pages
    $whitelist = array(
        'founder',
        'investments',
        'lifestyle',
        'contact',
        'ai-protocols',
        'intel',
        'sonic-universe',
        'ecosystem-partners',
        'llms.txt',
        'llms-full.txt',
    );
    foreach ( $whitelist as $allowed ) {
        if ( $uri_clean === $allowed || str_starts_with( $uri_clean, $allowed . '/' ) || str_contains( $uri_clean, 'founder' ) ) {
            return false;
        }
    }

    if ( preg_match( '~(?:^|/)(?:pep[a-z]*|glp-?1|sarm[a-z]*)(?:-|/|$)~i', $uri_clean ) ) {
        return true;
    }

    $patterns = keystone_get_purged_slug_patterns();
    foreach ( $patterns as $pattern ) {
        if ( str_contains( $uri_clean, $pattern ) ) {
            return true;
        }
    }

    return false;
}

/**
 * 1. HTTP 301 Permanent Redirect Interceptor on template_redirect (Priority 1)
 */
add_action( 'template_redirect', 'keystone_intercept_purged_urls', 1 );
function keystone_intercept_purged_urls(): void {
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';

    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return;
    }

    keystone_early_410_and_301_gate();

    $path = strtolower( trim( (string) ( parse_url( $request_uri, PHP_URL_PATH ) ?: '' ), '/' ) );

    // Active published posts and pages must NEVER be intercepted by the legacy fallback redirector
    if ( is_singular() ) {
        $post = get_post();
        if ( $post && 'publish' === $post->post_status ) {
            return;
        }
    }

    $core_slugs = array( 'founder', 'investments', 'lifestyle', 'contact', 'ai-protocols', 'intel', 'sonic-universe', 'ecosystem-partners' );
    foreach ( $core_slugs as $core_slug ) {
        if ( $path === $core_slug || str_starts_with( $path, $core_slug . '/' ) ) {
            return;
        }
    }

    if ( keystone_is_purged_url( $request_uri ) ) {
        wp_safe_redirect( home_url( '/' ), 301 );
        exit;
    }
}

/**
 * 2. Sanitize Rank Math XML Sitemaps
 */
add_filter( 'rank_math/sitemap/entry', 'keystone_filter_rank_math_sitemap', 10, 3 );
function keystone_filter_rank_math_sitemap( $url, string $type, $object ) {
    if ( empty( $url ) || ! is_array( $url ) || empty( $url['loc'] ) ) {
        return false;
    }

    $loc = (string) $url['loc'];

    if ( keystone_is_purged_url( $loc ) ) {
        return false;
    }

    if ( 'term' === $type && isset( $object->taxonomy ) && in_array( $object->taxonomy, array( 'post_tag', 'post_format' ), true ) ) {
        return false;
    }

    return $url;
}
