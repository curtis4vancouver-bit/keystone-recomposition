<?php
/**
 * Keystone Recomposition — Sovereign Page Media & SEO Database Synchronizer
 * Version: 3.3.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture / Wayne Stevenson
 * Purpose: Deterministically synchronizes clean titles, high-resolution lead media
 *          (featured images), and Rank Math SEO post metadata across the 8 canonical pages.
 *          Moves legacy duplicate/scratch pages (post-2366, post-2229, post-1, post-1325) to Trash.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Master Execution Engine for Sovereign Page Media & SEO Synchronization
 *
 * @return array<string, mixed> Execution status report.
 */
function keystone_execute_sovereign_page_media_seo_sync(): array {
    global $wpdb;

    if ( function_exists( 'wp_set_current_user' ) && ! current_user_can( 'manage_options' ) ) {
        wp_set_current_user( 1 );
    }

    $results = array(
        'timestamp'      => current_time( 'mysql' ),
        'pages_synced'   => array(),
        'trashed_posts'  => array(),
        'media_attached' => array(),
    );

    // 1. Move duplicate / legacy pages to Trash (post-2366, post-2229, post-1, post-1325)
    $target_trash_ids = array( 2366, 2229, 1, 1325 );
    foreach ( $target_trash_ids as $trash_id ) {
        $post = get_post( $trash_id );
        if ( $post && 'trash' !== $post->post_status ) {
            $wpdb->update(
                $wpdb->posts,
                array( 'post_status' => 'trash' ),
                array( 'ID' => $trash_id )
            );
            clean_post_cache( $trash_id );
            $results['trashed_posts'][] = array(
                'id'         => $trash_id,
                'post_title' => $post->post_title,
                'post_name'  => $post->post_name,
                'status'     => 'trashed',
            );
        }
    }

    // Also trash duplicate slugs like lifestyle-2 and legacy founder blueprints
    $duplicate_slugs = array( 'lifestyle-2', 'about-the-founder-the-keystone-blueprint' );
    foreach ( $duplicate_slugs as $dup_slug ) {
        $dup_posts = $wpdb->get_results( $wpdb->prepare(
            "SELECT ID, post_title, post_name FROM {$wpdb->posts} WHERE post_name = %s AND post_status != 'trash'",
            $dup_slug
        ) );
        if ( ! empty( $dup_posts ) ) {
            foreach ( $dup_posts as $dp ) {
                $wpdb->update(
                    $wpdb->posts,
                    array( 'post_status' => 'trash' ),
                    array( 'ID' => (int) $dp->ID )
                );
                clean_post_cache( (int) $dp->ID );
                $results['trashed_posts'][] = array(
                    'id'         => (int) $dp->ID,
                    'post_title' => $dp->post_title,
                    'post_name'  => $dp->post_name,
                    'status'     => 'trashed_duplicate_slug',
                );
            }
        }
    }

    // 2. Canonical 8 Pages Manifest
    $front_id = (int) get_option( 'page_on_front' ) ?: 12;
    $posts_id = (int) get_option( 'page_for_posts' ) ?: 119;

    $canonical_manifest = array(
        'home' => array(
            'preferred_id' => $front_id,
            'clean_title'  => 'Home',
            'slug'         => 'home',
            'asset_rel'    => 'assets/images/albums/sovereign_reverb.jpg',
            'attach_title' => 'Keystone Sovereign Reverb — Official Artwork',
            'focus_kw'     => 'Keystone Recomposition',
            'seo_title'    => 'Keystone Recomposition %sep% Autonomous AI Systems & Sonic Architecture',
            'seo_desc'     => 'Autonomous AI Multi-Agent Swarms, FastMCP Servers, Chrome DevTools Automation, and Sovereign Electronic Music Architecture by Wayne Stevenson.',
        ),
        'ai-protocols' => array(
            'preferred_id' => 2228,
            'clean_title'  => 'AI Protocols',
            'slug'         => 'ai-protocols',
            'asset_rel'    => 'assets/images/ai_protocols_banner.png',
            'attach_title' => 'Keystone AI Protocols — Multi-Agent Swarms',
            'focus_kw'     => 'Keystone AI Protocols',
            'seo_title'    => 'AI Protocols %sep% Autonomous Multi-Agent Swarms & FastMCP Infrastructure',
            'seo_desc'     => 'Explore Keystone AI Protocols: autonomous multi-agent swarm architecture, FastMCP tool contracts, and desktop automation systems engineered by Wayne Stevenson.',
        ),
        'intel' => array(
            'preferred_id' => $posts_id,
            'clean_title'  => 'INTEL',
            'slug'         => 'intel',
            'asset_rel'    => 'assets/images/ai_protocols_banner.png',
            'attach_title' => 'Keystone INTEL — Technical Research & Analysis',
            'focus_kw'     => 'Keystone Intel',
            'seo_title'    => 'INTEL %sep% Technical Evidence & Multi-Agent Architecture Research',
            'seo_desc'     => 'Technical engineering intelligence, multi-agent teardowns, and sovereign systems architecture published by Wayne Stevenson.',
        ),
        'sonic-universe' => array(
            'preferred_id' => 320,
            'clean_title'  => 'Sonic Universe',
            'slug'         => 'sonic-universe',
            'asset_rel'    => 'assets/images/sonic_universe_banner.png',
            'attach_title' => 'Keystone Sonic Universe — 22 Official Releases',
            'focus_kw'     => 'Keystone Sonic Universe',
            'seo_title'    => 'Sonic Universe %sep% 22 Official Releases & Spotify OAC Discography',
            'seo_desc'     => 'Wayne Stevenson official music catalog: 22 releases, 20 studio albums, 216 master recordings distributed worldwide via TooLost Digital on Spotify OAC.',
        ),
        'investments' => array(
            'preferred_id' => 2364,
            'clean_title'  => 'Investments',
            'slug'         => 'investments',
            'asset_rel'    => 'assets/images/trading_terminal_luxury.jpg',
            'attach_title' => 'Keystone Strategic Capital & Quantitative Markets',
            'focus_kw'     => 'Keystone Investments',
            'seo_title'    => 'Investments %sep% Quantitative Prediction Markets & Capital Deployment',
            'seo_desc'     => 'Quantitative market intelligence (EV >= +15%), 40% Cash Fortress, BC Bill 44 infill, and luxury Mexico Riviera Nayarit coastal villa development.',
        ),
        'lifestyle' => array(
            'preferred_id' => 2365,
            'clean_title'  => 'Lifestyle',
            'slug'         => 'lifestyle',
            'asset_rel'    => 'assets/images/bc_luxury_multiplex.jpg',
            'attach_title' => 'Keystone Sovereign Operations & Lifestyle',
            'focus_kw'     => 'Keystone Lifestyle',
            'seo_title'    => 'Lifestyle %sep% Sovereign Operations & Mountain Living Architecture',
            'seo_desc'     => 'High-performance mountain living across the Sea-to-Sky corridor, cold plunge and sauna recovery protocols, and BC Housing Licensed Builder #52603 infill.',
        ),
        'founder' => array(
            'preferred_id' => 2363,
            'clean_title'  => 'About the Founder',
            'slug'         => 'founder',
            'asset_rel'    => 'assets/images/wayne_avatar.jpg',
            'attach_title' => 'Wayne Stevenson — Founder & Managing Director',
            'focus_kw'     => 'Wayne Stevenson',
            'seo_title'    => 'About the Founder %sep% Wayne Stevenson Sovereign Blueprint',
            'seo_desc'     => 'Wayne Stevenson: Founder and Managing Director of Keystone Possibilities Ltd (BC Housing Builder #52603), AI systems architect, recording artist, and high-performance builder.',
        ),
        'contact' => array(
            'preferred_id' => 2367,
            'clean_title'  => 'Contact',
            'slug'         => 'contact',
            'asset_rel'    => 'assets/images/keystone_possibilities_crest.png',
            'attach_title' => 'Keystone Executive Contact Gateway',
            'focus_kw'     => 'Contact Keystone',
            'seo_title'    => 'Contact %sep% Executive Consultation & Partnership Gateway',
            'seo_desc'     => 'Direct executive consultation with Wayne Stevenson for AI workstation architecture, BC Bill 44 general contracting, and Spotify catalog rights.',
        ),
    );

    // 3. Process each canonical page
    foreach ( $canonical_manifest as $key => $page_def ) {
        $target_id = $page_def['preferred_id'];
        $post      = get_post( $target_id );

        // If ID does not match, locate by slug
        if ( ! $post || 'page' !== $post->post_type ) {
            $found_id = (int) $wpdb->get_var( $wpdb->prepare(
                "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = %s AND post_status = 'publish' LIMIT 1",
                $page_def['slug']
            ) );
            if ( $found_id > 0 ) {
                $target_id = $found_id;
                $post      = get_post( $target_id );
            }
        }

        if ( ! $post ) {
            continue;
        }

        // A. Ensure Clean Title in wp_posts
        if ( $post->post_title !== $page_def['clean_title'] ) {
            $wpdb->update(
                $wpdb->posts,
                array( 'post_title' => $page_def['clean_title'] ),
                array( 'ID' => $target_id )
            );
            clean_post_cache( $target_id );
        }

        // B. Upload or attach high-res Lead Picture (Featured Image)
        $attach_id = 0;
        $filename  = basename( $page_def['asset_rel'] );

        // Check if attachment already exists in the media library
        $existing_attach = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
            '%' . $wpdb->esc_like( $filename )
        ) );

        if ( $existing_attach > 0 ) {
            $attach_id = $existing_attach;
        } else {
            $asset_path = get_stylesheet_directory() . '/' . ltrim( $page_def['asset_rel'], '/' );
            if ( file_exists( $asset_path ) ) {
                $upload_dir = wp_upload_dir();
                $target_upload = $upload_dir['path'] . '/' . $filename;
                @copy( $asset_path, $target_upload );

                $filetype = wp_check_filetype( $filename, null );
                $attach_arr = array(
                    'guid'           => $upload_dir['url'] . '/' . $filename,
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => $page_def['attach_title'],
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $new_attach_id = wp_insert_attachment( $attach_arr, $target_upload, $target_id );
                if ( ! is_wp_error( $new_attach_id ) && $new_attach_id > 0 ) {
                    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) {
                        require_once ABSPATH . 'wp-admin/includes/image.php';
                    }
                    $attach_meta = wp_generate_attachment_metadata( $new_attach_id, $target_upload );
                    wp_update_attachment_metadata( $new_attach_id, $attach_meta );
                    $attach_id = (int) $new_attach_id;
                }
            }
        }

        if ( $attach_id > 0 ) {
            update_post_meta( $target_id, '_thumbnail_id', $attach_id );
            $attach_url = wp_get_attachment_url( $attach_id );
            if ( $attach_url ) {
                update_post_meta( $target_id, 'rank_math_facebook_image', $attach_url );
                update_post_meta( $target_id, 'rank_math_twitter_image', $attach_url );
                update_post_meta( $target_id, 'rank_math_facebook_image_id', $attach_id );
                update_post_meta( $target_id, 'rank_math_twitter_image_id', $attach_id );
            }
            $results['media_attached'][] = array(
                'page'          => $key,
                'page_id'       => $target_id,
                'attachment_id' => $attach_id,
                'filename'      => $filename,
            );
        }

        // C. Set Rank Math SEO post meta (Title, Description, Focus Keyword, Social Cards)
        update_post_meta( $target_id, 'rank_math_title', $page_def['seo_title'] );
        update_post_meta( $target_id, 'rank_math_description', $page_def['seo_desc'] );
        update_post_meta( $target_id, 'rank_math_focus_keyword', $page_def['focus_kw'] );
        update_post_meta( $target_id, 'rank_math_facebook_title', $page_def['seo_title'] );
        update_post_meta( $target_id, 'rank_math_facebook_description', $page_def['seo_desc'] );
        update_post_meta( $target_id, 'rank_math_twitter_title', $page_def['seo_title'] );
        update_post_meta( $target_id, 'rank_math_twitter_description', $page_def['seo_desc'] );
        update_post_meta( $target_id, 'rank_math_twitter_card_type', 'summary_large_image' );
        update_post_meta( $target_id, 'rank_math_robots', array( 'index' ) );

        $results['pages_synced'][] = array(
            'key'          => $key,
            'id'           => $target_id,
            'title'        => $page_def['clean_title'],
            'thumbnail_id' => $attach_id,
            'focus_kw'     => $page_def['focus_kw'],
        );
    }

    return $results;
}

// Hook into admin_init for reliable WordPress admin dashboard execution
add_action( 'admin_init', function() {
    $synced = get_option( 'keystone_sovereign_media_seo_synced_v3_3' );
    if ( ! $synced ) {
        keystone_execute_sovereign_page_media_seo_sync();
        update_option( 'keystone_sovereign_media_seo_synced_v3_3', '1' );
    }
} );

// Allow manual trigger via URL query parameter for Keystone Orchestration verification
add_action( 'init', function() {
    if ( isset( $_GET['keystone_sync_media_seo'] ) ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Unauthorized: Keystone Administrator privileges required.', 'Unauthorized', array( 'response' => 403 ) );
        }
        $report = keystone_execute_sovereign_page_media_seo_sync();
        header( 'Content-Type: application/json; charset=utf-8' );
        echo wp_json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        exit;
    }
} );
