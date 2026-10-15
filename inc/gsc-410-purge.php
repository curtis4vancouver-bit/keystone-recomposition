<?php
/**
 * Keystone Recomposition - Google Search Console Reset & HTTP 301 Redirect Engine
 * Version: 3.2.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 * Purpose: Intercepts all legacy peptide, workout, and obsolete pages and issues
 *          an atomic HTTP 301 Permanent Redirect to home_url( '/' ).
 *          Completely eliminates the Automattic edge proxy 410 disable screen ("This site is disabled"),
 *          preserves aged domain link equity, and purges XML sitemaps via Rank Math filters.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Canonical legacy slug patterns to permanently retire with HTTP 301 Redirect.
 */
function keystone_get_purged_slug_patterns(): array {
    return array(
        'mounjaro',
        'tirzepatide',
        'ozempic',
        'semaglutide',
        'cjc-1295',
        'cjc1295',
        'bpc-157',
        'bpc157',
        'wolverine-stack',
        'wolverine-protocol',
        'retatrutide',
        'epithalon',
        'ipamorelin',
        'tesamorelin',
        'aod9604',
        'aod-9604',
        'kpv',
        'tb500',
        'tb-500',
        'glp1',
        'glp-1',
        'peptide',
        'peptides',
        'bacteriostatic',
        'reconstitution',
        'peptide-calculator',
        'glp1-calculator',
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
    $uri_clean = strtolower( trim( $uri, '/' ) );
    
    // Explicit whitelist for core sovereign ecosystem pages
    $whitelist = array( 'founder', 'investments', 'lifestyle', 'contact', 'ai-protocols', 'intel', 'sonic-universe' );
    foreach ( $whitelist as $allowed ) {
        if ( $uri_clean === $allowed || str_starts_with( $uri_clean, $allowed . '/' ) || str_contains( $uri_clean, 'founder' ) ) {
            return false;
        }
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
    
    // Skip admin, REST API, cron, or login requests
    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return;
    }

    $path = strtolower( trim( parse_url( $request_uri, PHP_URL_PATH ) ?: '', '/' ) );

    // Canonical 301 Redirects for Founder & Sonic Universe
    if ( in_array( $path, array( 'about', 'about-the-founder', 'about-the-founder-the-keystone-blueprint' ), true ) ) {
        wp_safe_redirect( home_url( '/founder/' ), 301 );
        exit;
    }
    if ( $path === 'album' || str_starts_with( $path, 'album/' ) || $path === 'track' || str_starts_with( $path, 'track/' ) ) {
        wp_safe_redirect( home_url( '/sonic-universe/' ), 301 );
        exit;
    }

    // Active published posts and pages must NEVER be intercepted by the legacy purge engine!
    if ( is_singular() ) {
        $post = get_post();
        if ( $post && $post->post_status === 'publish' ) {
            return;
        }
    }

    // Never redirect core sovereign ecosystem pages
    $core_slugs = array( 'founder', 'investments', 'lifestyle', 'contact', 'ai-protocols', 'intel', 'sonic-universe' );
    foreach ( $core_slugs as $core_slug ) {
        if ( $path === $core_slug || str_starts_with( $path, $core_slug . '/' ) ) {
            return;
        }
    }

    // Check current URI against canonical purged patterns
    $is_match = keystone_is_purged_url( $request_uri );

    if ( $is_match ) {
        // Enforce HTTP 301 Permanent Redirect directly to Sovereign Home
        wp_safe_redirect( home_url( '/' ), 301 );
        exit;
    }
}

/**
 * 2. Sanitize Rank Math XML Sitemaps
 * Strips all legacy peptide, GLP-1, workout, and watch URLs from XML sitemaps before output.
 */
add_filter( 'rank_math/sitemap/entry', 'keystone_filter_rank_math_sitemap', 10, 3 );
function keystone_filter_rank_math_sitemap( $url, string $type, $object ) {
    if ( empty( $url ) || ! is_array( $url ) || empty( $url['loc'] ) ) {
        return false;
    }

    $loc = (string) $url['loc'];

    if ( keystone_is_purged_url( $loc ) ) {
        return false; // Strips from XML sitemap
    }

    // Exclude thin tag, format, or author archives
    if ( 'term' === $type && isset( $object->taxonomy ) && in_array( $object->taxonomy, array( 'post_tag', 'post_format' ), true ) ) {
        return false;
    }

    return $url;
}
