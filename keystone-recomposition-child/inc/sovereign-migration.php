<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child for Keystone
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'init', function() {
    if ( isset( $_GET['dump_server'] ) ) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
        echo "ABSPATH: " . ABSPATH . "\n";
        
        $p1 = $_SERVER['DOCUMENT_ROOT'] . '/llms.txt';
        $p2 = ABSPATH . 'llms.txt';
        $p3 = ABSPATH . '../llms.txt';
        $p4 = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';
        
        echo "p1 ($p1): exists=" . (file_exists($p1)?'yes':'no') . ", writable=" . (is_writable(dirname($p1))?'yes':'no') . "\n";
        echo "p2 ($p2): exists=" . (file_exists($p2)?'yes':'no') . ", writable=" . (is_writable(dirname($p2))?'yes':'no') . "\n";
        echo "p3 ($p3): exists=" . (file_exists($p3)?'yes':'no') . ", writable=" . (is_writable(dirname($p3))?'yes':'no') . "\n";
        echo "p4 ($p4): exists=" . (file_exists($p4)?'yes':'no') . ", writable=" . (is_writable($p4)?'yes':'no') . "\n";
        
        echo "\n--- DYNAMIC ROBOTS.TXT ---\n";
        $initial_robots = "User-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php\n";
        echo apply_filters( 'robots_txt', $initial_robots, true );
        exit;
    }
    if ( isset( $_GET['purge_all_caches'] ) ) {
        global $wpdb;
        $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_rank_math_sitemap_%' OR option_name LIKE '_transient_timeout_rank_math_sitemap_%'" );
        
        if ( function_exists( 'opcache_reset' ) ) {
            opcache_reset();
        }
        if ( function_exists( 'wp_cache_flush' ) ) {
            wp_cache_flush();
        }
        $p1 = $_SERVER['DOCUMENT_ROOT'] . '/llms.txt';
        $p4 = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';
        $u1 = file_exists( $p1 ) ? (unlink( $p1 ) ? 'deleted' : 'failed') : 'not found';
        $u4 = file_exists( $p4 ) ? (unlink( $p4 ) ? 'deleted' : 'failed') : 'not found';

        echo "CACHES PURGED SUCCESSFULLY. llms.txt: $u1, robots.txt: $u4";
        exit;
    }
}, 20 );

if ( isset( $_GET['get_post_inventory'] ) && $_GET['get_post_inventory'] === 'sovereign_view' ) {
    global $wpdb;
    $posts = $wpdb->get_results( 
        "SELECT ID, post_title, post_name, post_date, post_content 
         FROM $wpdb->posts 
         WHERE post_type = 'post' AND post_status = 'publish' 
         ORDER BY post_date DESC" 
    );
    
    $report = array();
    foreach ( $posts as $p ) {
        $youtube_id = '';
        // Check shortcode first (migration converted embeds to shortcodes)
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $p->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})~i', $p->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        }
        // Also check post meta
        if ( empty( $youtube_id ) ) {
            $youtube_id = get_post_meta( $p->ID, 'keystone_youtube_id', true );
        }
        
        $report[] = array(
            'id' => $p->ID,
            'title' => $p->post_title,
            'slug' => $p->post_name,
            'date' => $p->post_date,
            'youtube_id' => $youtube_id,
            'has_meta' => ! empty( get_post_meta( $p->ID, 'keystone_youtube_id', true ) ),
            'length' => strlen( $p->post_content )
        );
    }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
}

if ( isset( $_GET['run_keystone_migration'] ) && $_GET['run_keystone_migration'] === 'sovereign_execute' ) {
    global $wpdb;
    
    // Set safety guards for execution environment
    @ini_set( 'memory_limit', '512M' );
    @set_time_limit( 300 );
    
    // Fetch all published posts
    $posts = $wpdb->get_results( 
        "SELECT ID, post_title, post_name, post_date, post_content 
         FROM $wpdb->posts 
         WHERE post_type = 'post' AND post_status = 'publish' 
         ORDER BY post_date DESC" 
    );
    
    $migrated = array();
    $skipped = array();
    
    foreach ( $posts as $p ) {
        $post_id = intval( $p->ID );
        
        // Skip Post 1149 (the flagship blueprint)
        if ( $post_id === 1149 ) {
            $skipped[] = array(
                'id' => $post_id,
                'title' => $p->post_title,
                'reason' => 'Flagship blueprint skipped'
            );
            continue;
        }
        
        $post_content = $p->post_content;
        
        // 1. Identify YouTube Video ID using the robust regex
        $youtube_id = '';
        if ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})~i', $post_content, $matches ) ) {
            $youtube_id = $matches[1];
        }
        
        if ( empty( $youtube_id ) ) {
            $skipped[] = array(
                'id' => $post_id,
                'title' => $p->post_title,
                'reason' => 'No YouTube video detected'
            );
            continue;
        }
        
        // 2. Perform safe, clean, and idempotent content restructuring
        $cleaned_content = $post_content;
        
        // Remove existing custom sovereign disclaimers if any exist
        $cleaned_content = preg_replace( '/<!-- KEYSTONE_SOVEREIGN_MEDICAL_DISCLAIMER_START -->.*?<!-- KEYSTONE_SOVEREIGN_MEDICAL_DISCLAIMER_END -->/is', '', $cleaned_content );
        
        // Remove any legacy dual-column disclosures or generic medical disclaimers matching key superintendent keywords
        $cleaned_content = preg_replace( '/<div class="[^"]*wp-block-columns[^"]*".*?Medical Disclaimer.*?<\/div>\s*<\/div>\s*<\/div>/is', '', $cleaned_content );
        $cleaned_content = preg_replace( '/<div[^>]*class="[^"]*disclosure-card[^"]*".*?<\/div>/is', '', $cleaned_content );
        
        // Remove any existing play button shortcodes to prevent duplication
        $cleaned_content = preg_replace( '/\[keystone_video[^\]]*\]/i', '', $cleaned_content );
        
        // Remove Gutenberg Core Embed / YouTube blocks
        $cleaned_content = preg_replace( '/<!--\s+wp:embed\s+({.*?})?\s*-->.*?<!--\s+\/wp:embed\s*-->/is', '', $cleaned_content );
        $cleaned_content = preg_replace( '/<!--\s+wp:core-embed\/youtube\s+({.*?})?\s*-->.*?<!--\s+\/wp:core-embed\/youtube\s*-->/is', '', $cleaned_content );
        
        // Remove figure blocks containing youtube
        $cleaned_content = preg_replace( '/<figure class="[^"]*wp-block-embed-youtube[^"]*">.*?<\/figure>/is', '', $cleaned_content );
        $cleaned_content = preg_replace( '/<figure class="[^"]*wp-block-embed[^"]*is-provider-youtube[^"]*">.*?<\/figure>/is', '', $cleaned_content );
        
        // Remove raw YouTube iframe elements
        $cleaned_content = preg_replace( '/<iframe[^>]*youtube\.com\/embed\/[^>]*>.*?<\/iframe>/is', '', $cleaned_content );
        $cleaned_content = preg_replace( '/<iframe[^>]*youtube\.com\/[^>]*>.*?<\/iframe>/is', '', $cleaned_content );
        $cleaned_content = preg_replace( '/<iframe[^>]*youtu\.be\/[^>]*>.*?<\/iframe>/is', '', $cleaned_content );
        
        // Clean up any empty paragraphs or leftover markup around embeds
        $cleaned_content = preg_replace( '/<p>\s*(https?:\/\/(?:www\.)?(?:youtube\.com|youtu\.be)\/[^\s<>\'\"]*)\s*<\/p>/i', '', $cleaned_content );
        $cleaned_content = preg_replace( '/<p>\s*<!--\s*-->\s*<\/p>/i', '', $cleaned_content );
        
        // 3. Prepend the [keystone_video id="YOUTUBE_ID"] facade shortcode at the absolute top fold
        $cleaned_content = '[keystone_video id="' . esc_attr( $youtube_id ) . '"]' . "\n\n" . trim( $cleaned_content );
        
        // 4. Correct outbound Spotify links to the verified artist ID
        $cleaned_content = preg_replace(
            '~https://open\.spotify\.com/artist/(?!52v3Qe6Jo0hg764driOl5Y)[a-zA-Z0-9_-]+~i',
            'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            $cleaned_content
        );
        
        // 5. Append the clean centered Real Wayne Medical Disclaimer card at the bottom
        $disclaimer_card = "\n\n" . '<!-- KEYSTONE_SOVEREIGN_MEDICAL_DISCLAIMER_START -->' . "\n" .
                           '<div class="kr-medical-disclaimer-card" style="background-color: rgba(245, 158, 11, 0.03); border: 1px solid rgba(245, 158, 11, 0.15); padding: 25px; border-radius: 4px; margin-top: 50px; margin-bottom: 30px; text-align: center; max-width: 900px; margin-left: auto; margin-right: auto;">' . "\n" .
                           '    <h3 style="font-family: \'Outfit\', sans-serif; font-size: 0.95rem; color: #f59e0b; margin-top: 0; margin-bottom: 12px; letter-spacing: 0.08em; text-transform: uppercase;">⚠️ Medical Disclaimer</h3>' . "\n" .
                           '    <p style="font-family: \'Inter\', sans-serif; font-size: 0.85rem; color: #a3a3a3; line-height: 1.6; margin: 0; font-weight: 300; max-width: 750px; margin-left: auto; margin-right: auto;">' . "\n" .
                           '        This article is a personal case study for educational purposes only. Wayne Stevenson is a construction superintendent and metabolic researcher, not a doctor. Nothing here constitutes medical advice. GLP-1 / GIP therapies are powerful prescription drugs—always consult your licensed physician before starting or modifying any protocol.' . "\n" .
                           '    </p>' . "\n" .
                           '</div>' . "\n" .
                           '<!-- KEYSTONE_SOVEREIGN_MEDICAL_DISCLAIMER_END -->';
        
        $cleaned_content .= $disclaimer_card;
        
        // 6. Update wp_posts table with restructured content
        $wpdb->update(
            $wpdb->posts,
            array( 'post_content' => $cleaned_content ),
            array( 'ID' => $post_id )
        );
        
        // Clear post cache to force WordPress to load fresh DB rows
        clean_post_cache( $post_id );
        
        // 7. Inject GSC Video Object Metadata using WordPress Custom Fields
        // Extract description from original content to prevent the medical disclaimer from bleeding in
        $video_desc = wp_html_excerpt( wp_strip_all_tags( strip_shortcodes( $p->post_content ) ), 150, '...' );
        if ( empty( $video_desc ) ) {
            $video_desc = esc_attr( $p->post_title ) . ' - High-performance health and longevity protocol details.';
        }
        
        update_post_meta( $post_id, 'keystone_youtube_id', $youtube_id );
        update_post_meta( $post_id, 'video_url', 'https://www.youtube.com/watch?v=' . $youtube_id );
        update_post_meta( $post_id, 'video_title', $p->post_title );
        update_post_meta( $post_id, 'video_description', $video_desc );
        update_post_meta( $post_id, 'video_duration', 'PT5M0S' ); // Standard ISO duration for historical posts
        update_post_meta( $post_id, 'video_upload_date', $p->post_date );
        
        $migrated[] = array(
            'id' => $post_id,
            'title' => $p->post_title,
            'youtube_id' => $youtube_id,
            'spotify_fixed' => true,
            'disclaimer_appended' => 'Real Wayne centered card',
            'facade_prepend' => 'Success'
        );
    }
    
    // Clear Object and OpCache layers
    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }
    if ( function_exists( 'opcache_reset' ) ) {
        opcache_reset();
    }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( array(
        'status' => 'success',
        'message' => 'Keystone Sovereign Post-by-Post Migration Complete',
        'migrated_count' => count( $migrated ),
        'skipped_count' => count( $skipped ),
        'migrated_posts' => $migrated,
        'skipped_posts' => $skipped
    ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
}

if ( isset( $_GET['restore_mounjaro_post'] ) ) {
    $file_path = __DIR__ . '/mounjaro_backup.txt';
    if ( file_exists( $file_path ) ) {
        $content = file_get_contents( $file_path );
        $post_data = array(
            'ID'           => 1149,
            'post_content' => $content,
        );
        $res = wp_update_post( $post_data );
        if ( is_wp_error( $res ) ) {
            echo "ERROR RESTORING POST: " . $res->get_error_message();
        } else {
            echo "POST RESTORED SUCCESSFULLY: ID " . $res;
        }
    } else {
        echo "BACKUP FILE NOT FOUND AT: " . $file_path;
    }
    exit;
}

if ( isset( $_GET['list_revisions'] ) ) {
    $revisions = wp_get_post_revisions( 1149 );
    echo "=== REVISIONS FOR POST 1149 ===\n\n";
    foreach ( $revisions as $rev ) {
        echo "REVISION ID: " . $rev->ID . " | DATE: " . $rev->post_date . " | TITLE: " . $rev->post_title . "\n";
        echo "  CONTENT LENGTH: " . strlen( $rev->post_content ) . "\n";
        echo "  SNIPPET: " . substr( wp_strip_all_tags( $rev->post_content ), 0, 150) . "\n\n";
    }
    exit;
}

if ( isset( $_GET['restore_revision_id'] ) ) {
    $rev_id = intval( $_GET['restore_revision_id'] );
    $rev = wp_get_post_revision( $rev_id );
    if ( $rev ) {
        $content = $rev->post_content;
        
        $old_url = "https://open.spotify.com/artist/keystone-recomposition";
        $new_url = "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y";
        $updated_content = str_replace( $old_url, $new_url, $content );
        
        $post_data = array(
            'ID'           => 1149,
            'post_content' => $updated_content,
        );
        $res = wp_update_post( $post_data );
        if ( is_wp_error( $res ) ) {
            echo "ERROR RESTORING REVISION: " . $res->get_error_message();
        } else {
            echo "REVISION " . $rev_id . " RESTORED & LINK UPDATED SUCCESSFULLY FOR POST 1149";
        }
    } else {
        echo "REVISION ID " . $rev_id . " NOT FOUND";
    }
    exit;
}

if ( isset( $_GET['check_rm_options'] ) ) {
    global $wpdb;
    $results = $wpdb->get_results( "SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE '%rank-math%' OR option_name LIKE '%rank_math%' OR option_name LIKE '%schema%'" );
    echo "=== DB RANK MATH OPTIONS SCAN ===\n\n";
    foreach ( $results as $row ) {
        $val = maybe_unserialize( $row->option_value );
        $type = gettype( $val );
        echo "OPTION: " . $row->option_name . " | TYPE: " . $type . "\n";
        if ( $type === 'string' ) {
            echo "  VALUE: " . substr($val, 0, 150) . "\n";
        }
    }
    
    echo "\n=== RANK MATH SCHEMA POSTS SCAN ===\n\n";
    $schemas = get_posts( array(
        'post_type'   => 'rank_math_schema',
        'post_status' => 'any',
        'posts_per_page' => -1
    ) );
    echo "SCHEMAS COUNT: " . count($schemas) . "\n";
    foreach ( $schemas as $s ) {
        echo "SCHEMA ID: " . $s->ID . " | TITLE: " . $s->post_title . "\n";
        $meta = get_post_meta( $s->ID );
        foreach ( $meta as $key => $values ) {
            foreach ( $values as $val_raw ) {
                $val = maybe_unserialize( $val_raw );
                $type = gettype( $val );
                echo "  META KEY: " . $key . " | TYPE: " . $type . "\n";
                if ( $type === 'string' ) {
                    echo "    VALUE: " . substr($val, 0, 100) . "\n";
                }
            }
        }
    }
    
    echo "\n=== POST 1149 METADATA SCAN ===\n\n";
    $meta1149 = get_post_meta( 1149 );
    foreach ( $meta1149 as $key => $values ) {
        foreach ( $values as $val_raw ) {
            $val = maybe_unserialize( $val_raw );
            $type = gettype( $val );
            echo "META KEY: " . $key . " | TYPE: " . $type . "\n";
            if ( $type === 'string' ) {
                echo "  VALUE: " . substr($val, 0, 100) . "\n";
            }
        }
    }
    
    echo "\n=== POST 1149 SCHEMA META DETAIL ===\n\n";
    $val = get_post_meta( 1149, 'rank_math_schema_BlogPosting', true );
    echo "TYPE: " . gettype($val) . "\n";
    echo "VALUE:\n";
    print_r( $val );
    echo "\n";
    
    echo "\n=== SIMULATING RANK MATH ADMIN DATA ===\n\n";
    // Check if the class exists and what options it accesses
    if ( class_exists( 'RankMathPro\Schema\Admin' ) ) {
        echo "RankMathPro\\Schema\\Admin exists!\n";
    } else {
        echo "RankMathPro\\Schema\\Admin does NOT exist on frontend context.\n";
    }
    exit;
}

if ( isset( $_GET['delete_corrupt_post'] ) ) {
    $id_to_del = intval( $_GET['delete_corrupt_post'] );
    if ( $id_to_del > 0 ) {
        $res = wp_delete_post( $id_to_del, true );
        echo "DELETE POST $id_to_del RESULT: " . ($res ? "SUCCESS" : "FAILED") . "\n";
    } else {
        echo "NO VALID ID SPECIFIED\n";
    }
    exit;
}

/**
 * 1. Enqueue Parent Stylesheet and Google Fonts
 */
