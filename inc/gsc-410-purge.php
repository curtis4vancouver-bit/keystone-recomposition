<?php
/**
 * Keystone Recomposition — Google Search Console Reset & HTTP 410 Gone Engine
 * Version: 3.0.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 * Purpose: Authoritative elimination of legacy peptide/GLP-1 URLs under RFC 9110 §15.5.11.
 *          Halts Googlebot crawl loops, purges XML sitemaps, and serves Quiet Luxury 410 UI.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Canonical legacy slug patterns to permanently retire with HTTP 410 Gone.
 */
function keystone_get_purged_slug_patterns(): array {
    return array(
        'mounjaro',
        'tirzepatide',
        'semaglutide',
        'cjc-1295',
        'cjc1295',
        'bpc-157',
        'bpc157',
        'wolverine-stack',
        'wolverine-protocol',
        'wolverine',
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
        'watch-',
    );
}

/**
 * Checks if a given URI or slug matches any purged legacy pattern.
 */
function keystone_is_purged_url( string $uri ): bool {
    $uri_clean = strtolower( trim( $uri, '/' ) );
    
    // Check watch- prefix
    if ( str_starts_with( $uri_clean, 'watch-' ) || str_contains( $uri_clean, '/watch-' ) ) {
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
 * 1. HTTP 410 Gone Interceptor on template_redirect (Priority 1)
 */
add_action( 'template_redirect', 'keystone_intercept_purged_urls', 1 );
function keystone_intercept_purged_urls(): void {
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    
    // Skip admin, REST API, cron, or login requests
    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return;
    }

    // Check current URI or queried post
    $is_match = keystone_is_purged_url( $request_uri );
    
    if ( ! $is_match && is_singular() ) {
        $post = get_post();
        if ( $post && ( keystone_is_purged_url( $post->post_name ) || keystone_is_purged_url( $post->post_title ) ) ) {
            $is_match = true;
        }
    }

    if ( $is_match ) {
        // Enforce RFC 9110 HTTP 410 Gone
        status_header( 410 );
        header( 'Status: 410 Gone' );
        header( 'X-Robots-Tag: noindex, nofollow' );
        header( 'Cache-Control: public, max-age=86400' );

        $template_410 = get_stylesheet_directory() . '/410.php';
        if ( file_exists( $template_410 ) ) {
            include $template_410;
        } else {
            keystone_render_fallback_410();
        }
        exit;
    }
}

/**
 * 2. Sanitize Rank Math XML Sitemaps
 * Strips all legacy peptide, GLP-1, and watch URLs from XML sitemaps before output.
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

// Disable sitemap caching for instant re-indexing
add_filter( 'rank_math/sitemap/enable_caching', '__return_false' );

/**
 * 3. Fallback Quiet Luxury 410 Template
 */
function keystone_render_fallback_410(): void {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>410 Gone — Protocol Retired | Keystone Recomposition</title>
        <meta name="robots" content="noindex, nofollow">
        <style>
            :root {
                --bg-primary: #030712;
                --gold-primary: #d4af37;
                --gold-light: #f6d365;
                --cyan-neon: #00f0ff;
                --text-primary: #f8fafc;
                --text-secondary: #94a3b8;
            }
            body {
                background: var(--bg-primary);
                color: var(--text-primary);
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                margin: 0;
                padding: 40px 20px;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                box-sizing: border-box;
            }
            .card-410 {
                max-width: 680px;
                width: 100%;
                background: rgba(15, 23, 42, 0.85);
                border: 1px solid rgba(212, 175, 55, 0.4);
                border-radius: 20px;
                padding: 40px;
                text-align: center;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8), 0 0 30px rgba(212, 175, 55, 0.15);
                backdrop-filter: blur(16px);
            }
            .badge-410 {
                display: inline-block;
                background: rgba(212, 175, 55, 0.15);
                color: var(--gold-light);
                border: 1px solid var(--gold-primary);
                padding: 6px 16px;
                border-radius: 9999px;
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                margin-bottom: 20px;
            }
            h1 {
                font-size: 1.8rem;
                margin: 0 0 16px 0;
                color: #ffffff;
                letter-spacing: -0.02em;
            }
            p {
                color: var(--text-secondary);
                line-height: 1.7;
                font-size: 1.05rem;
                margin-bottom: 30px;
            }
            .btn-group {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }
            @media (min-width: 540px) {
                .btn-group { flex-direction: row; justify-content: center; }
            }
            .btn-gold {
                background: linear-gradient(135deg, #d4af37 0%, #f6d365 50%, #aa820a 100%);
                color: #030712;
                font-weight: 700;
                padding: 14px 28px;
                border-radius: 9999px;
                text-decoration: none;
                transition: transform 0.2s, box-shadow 0.2s;
            }
            .btn-gold:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
            }
            .btn-glass {
                background: rgba(255, 255, 255, 0.06);
                color: var(--text-primary);
                border: 1px solid rgba(255, 255, 255, 0.15);
                font-weight: 600;
                padding: 14px 28px;
                border-radius: 9999px;
                text-decoration: none;
                transition: background 0.2s;
            }
            .btn-glass:hover {
                background: rgba(255, 255, 255, 0.12);
            }
        </style>
    </head>
    <body>
        <div class="card-410">
            <span class="badge-410">HTTP 410 — PROTOCOL RETIRED</span>
            <h1>This Protocol Has Been Permanently Retired</h1>
            <p>
                As part of Keystone Recomposition's 2026 architectural evolution, all legacy metabolic and peptide case studies have been permanently removed from our digital index. We invite you to explore our Autonomous AI Systems or our 18-Album Sonic Universe.
            </p>
            <div class="btn-group">
                <a href="/ai-protocols/" class="btn-gold">Explore AI Protocols →</a>
                <a href="/sonic-universe/" class="btn-glass">Listen to Sonic Universe →</a>
                <a href="/about-the-founder/" class="btn-glass">About Founder →</a>
            </div>
        </div>
    </body>
    </html>
    <?php
}

/**
 * 4. Safe Database Purge & Backup Utility
 * Exports matching posts to JSON snapshot before trashing.
 */
function keystone_backup_and_purge_legacy_posts( bool $execute_delete = false ): array {
    global $wpdb;

    $patterns = keystone_get_purged_slug_patterns();
    $like_clauses = array();
    foreach ( $patterns as $p ) {
        $like_clauses[] = $wpdb->prepare( "post_name LIKE %s", '%' . $wpdb->esc_like( $p ) . '%' );
    }
    $where_sql = implode( ' OR ', $like_clauses );

    $query = "SELECT ID, post_title, post_name, post_date, post_status FROM {$wpdb->posts} WHERE post_type = 'post' AND ({$where_sql})";
    $results = $wpdb->get_results( $query, ARRAY_A );

    $backup_file = 'C:\\Users\\Curtis\\Desktop\\Keystone Brain\\.system_generated\\legacy_posts_backup.json';
    @wp_mkdir_p( dirname( $backup_file ) );
    @file_put_contents( $backup_file, json_encode( $results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) );

    $purged_count = 0;
    if ( $execute_delete && ! empty( $results ) ) {
        $ids = wp_list_pluck( $results, 'ID' );
        foreach ( $ids as $id ) {
            wp_trash_post( (int) $id );
            $purged_count++;
        }
        wp_cache_flush();
    }

    return array(
        'found_count'  => count( $results ),
        'purged_count' => $purged_count,
        'backup_path'  => $backup_file,
    );
}
